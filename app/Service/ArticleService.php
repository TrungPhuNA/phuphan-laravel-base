<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 1/23/25
 */

namespace App\Service;

use App\Repositories\Contracts\ArticleRepositoryInterface;
use Illuminate\Support\Str;

class ArticleService
{
    protected ArticleRepositoryInterface $articleRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * @param $params
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($params)
    {
        return $this->articleRepository->paginate($params);
    }

    public function getListsArticles($params)
    {
        return $this->articleRepository->getListsArticles($params);
    }

    /**
     * @param $articleDto
     * @return mixed
     */
    public function create($articleDto)
    {
        $articleDto["slug"] = Str::slug($articleDto["name"]);
        return $this->articleRepository->create($articleDto);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function findById($id)
    {
        return $this->articleRepository->find($id);
    }

    /**
     * @param $id
     * @param $articleDto
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function update($id, $articleDto) {
        $articleDto["slug"] = Str::slug($articleDto["name"]);
        return $this->articleRepository->update($id, $articleDto);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) {
        return $this->articleRepository->delete($id);
    }

    /**
     * @param $tags
     * @param $idArticle
     * @return void
     */
    public function syncTags($tags, $idArticle)
    {
        if (!empty($tags)) {
            $datas = [];
            foreach ($tags as $key => $tag) {
                $datas[] = [
                    'article_id' => $idArticle,
                    'tag_id'     => $tag
                ];
            }

            \DB::table('bl_articles_tags')->where('article_id', $idArticle)->delete();
            \DB::table('bl_articles_tags')->insert($datas);
        }
    }

    /**
     * @param $articleID
     * @return array
     */
    public function getTagIdByArticle($articleID)
    {
        return \DB::table('bl_articles_tags')
            ->where('article_id', $articleID)
            ->pluck('tag_id')
            ->toArray() ?? [];
    }
}