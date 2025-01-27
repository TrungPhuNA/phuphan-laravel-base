<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 1/27/25
 */

namespace App\Service;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Str;

class ProductService
{
    protected ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getListsProducts($params = [], $columns = ["*"])
    {
        return $this->productRepository->getListsProducts($params, $columns);
    }

    /**
     * @param $params
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($params)
    {
        return $this->productRepository->paginate($params);
    }

    /**
     * @param $modelDto
     * @return mixed
     */
    public function create($modelDto)
    {
        $modelDto["slug"] = Str::slug($modelDto["name"]);
        return $this->productRepository->create($modelDto);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function findById($id)
    {
        return $this->productRepository->find($id);
    }

    /**
     * @param $id
     * @param $modelDto
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function update($id, $modelDto)
    {
        $modelDto["slug"] = Str::slug($modelDto["name"]);
        return $this->productRepository->update($id, $modelDto);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->productRepository->delete($id);
    }

    /**
     * @param $labels
     * @param $productID
     * @return void
     */
    public function syncLabels($labels = [], $productID)
    {
        if (!empty($labels)) {
            $datas = [];
            foreach ($labels as $key => $label) {
                $datas[] = [
                    'product_id'       => $productID,
                    'product_label_id' => $label
                ];
            }

            \DB::table('ec_products_labels')->where('product_id', $productID)->delete();
            \DB::table('ec_products_labels')->insert($datas);
        }
    }

    /**
     * @param $productID
     * @return array
     */
    public function getLabelsIdByProduct($productID)
    {
        return \DB::table('ec_products_labels')
            ->where('product_id', $productID)
            ->pluck('product_label_id')
            ->toArray() ?? [];
    }
}