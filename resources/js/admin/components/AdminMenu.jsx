import React, { useState, useEffect } from "react";
import axios from "axios";
import { ReactSortable } from "react-sortablejs";
import { FaEdit, FaTrash, FaSave, FaChevronDown, FaChevronRight } from "react-icons/fa";

const AdminMenu = () => {
    const [menuItems, setMenuItems] = useState([]);
    const [editingItem, setEditingItem] = useState(null);
    const [expandedMenus, setExpandedMenus] = useState({});
    const [newLink, setNewLink] = useState({ title: "", url: "/", icon: "", avatar: "", target: "_self", status: "published" });

    useEffect(() => {
        fetchMenu();
    }, []);

    const fetchMenu = async () => {
        try {
            const response = await axios.get("/admin/menu/api");
            if (response.data?.data?.menu) {
                let menu = response.data?.data?.menu;
                setMenuItems(menu.sub_menus ? menu.sub_menus : []);
            }
        } catch (error) {
            console.error("Error fetching menu", error);
        }
    };

    // Toggle mở rộng menu cha
    const toggleExpand = (id) => {
        setExpandedMenus((prev) => ({ ...prev, [id]: !prev[id] }));
    };

    // Thêm mục mới vào menu
    const addToMenu = (name, type) => {
        setMenuItems([...menuItems, { id: Date.now(), name, type, url: "#", icon: "", avatar: "", target: "_self", status: "published", sub_menus: [] }]);
    };

    // Thêm link tùy chỉnh
    const addCustomLink = () => {
        if (!newLink.title) return alert("Please enter a title");
        setMenuItems([...menuItems, { ...newLink, id: Date.now(), type: "Custom Link", sub_menus: [] }]);
        setNewLink({ title: "", url: "/", icon: "", avatar: "", target: "_self", status: "published" });
    };

    // Cập nhật giá trị menu hoặc submenu
    const updateMenuItem = (item, key, value) => {
        item[key] = value;
        setMenuItems([...menuItems]);
    };

    // Xóa mục menu hoặc submenu
    const deleteMenuItem = (list, setList, index) => {
        if (!window.confirm("Are you sure?")) return;
        setList(list.filter((_, i) => i !== index));
    };

    // Lưu menu sau khi chỉnh sửa
    const saveEditing = () => {
        setEditingItem(null);
    };

    // Gửi menu lên API
    const saveMenu = async () => {
        try {
            await axios.post("/admin/menu/api/save", { sub_menus: menuItems });
            alert("Menu saved successfully!");
        } catch (error) {
            console.error("Error saving menu", error);
            alert("Failed to save menu");
        }
    };

    return (
        <div className="row">
            {/* Cột trái: Chọn danh mục */}
            <div className="col-md-3">
                <h5>Add to Menu</h5>
                <div className="card p-3">
                    <h6>Pages</h6>
                    <ul className="list-group">
                        <li className="list-group-item">
                            About <button className="btn btn-sm btn-outline-primary float-end" onClick={() => addToMenu("About", "Page")}>+ Add</button>
                        </li>
                        <li className="list-group-item">
                            Blog <button className="btn btn-sm btn-outline-primary float-end" onClick={() => addToMenu("Blog", "Page")}>+ Add</button>
                        </li>
                    </ul>

                    <h6 className="mt-3">Categories</h6>
                    <ul className="list-group">
                        <li className="list-group-item">
                            Electronics <button className="btn btn-sm btn-outline-primary float-end" onClick={() => addToMenu("Electronics", "Category")}>+ Add</button>
                        </li>
                    </ul>

                    <h6 className="mt-3">Add Link</h6>
                    <input type="text" className="form-control mb-2" placeholder="Title" value={newLink.title} onChange={(e) => setNewLink({ ...newLink, title: e.target.value })} />
                    <input type="text" className="form-control mb-2" placeholder="URL" value={newLink.url} onChange={(e) => setNewLink({ ...newLink, url: e.target.value })} />
                    <button className="btn btn-primary w-100" onClick={addCustomLink}>+ Add to Menu</button>
                </div>
            </div>

            {/* Cột giữa: Hiển thị menu cha - con */}
            <div className="col-md-6">
                <h5>Menu Structure</h5>
                <div className="card p-3">
                    <ReactSortable list={menuItems} setList={setMenuItems} group="nested" animation={200} fallbackOnBody={true} swapThreshold={0.65} ghostClass="sortable-ghost">
                        {menuItems.map((item, index) => (
                            <div key={item.id} className="list-group-item">
                                <div className="d-flex justify-content-between align-items-center">
                                    <span onClick={() => toggleExpand(item.id)} style={{ cursor: "pointer" }}>
                                        {item.sub_menus.length > 0 ? (
                                            expandedMenus[item.id] ? <FaChevronDown /> : <FaChevronRight />
                                        ) : null} {item.name}
                                    </span>
                                    <div>
                                        <button className="btn btn-sm btn-warning me-2" onClick={() => setEditingItem(item)}>
                                            <FaEdit />
                                        </button>
                                        <button className="btn btn-sm btn-danger" onClick={() => deleteMenuItem(menuItems, setMenuItems, index)}>
                                            <FaTrash />
                                        </button>
                                    </div>
                                </div>

                                {/* Hiển thị form chỉnh sửa */}
                                {editingItem === item && (
                                    <div className="mt-2 p-2 border rounded">
                                        <input type="text" className="form-control form-control-sm mb-2" placeholder="Tên" value={item.name} onChange={(e) => updateMenuItem(item, "name", e.target.value)} />
                                        <input type="text" className="form-control form-control-sm mb-2" placeholder="URL" value={item.url} onChange={(e) => updateMenuItem(item, "url", e.target.value)} />
                                        <button className="btn btn-sm btn-success w-100" onClick={saveEditing}><FaSave /> Save</button>
                                    </div>
                                )}

                                {/* Hiển thị menu con */}
                                {expandedMenus[item.id] && (
                                    <ul className="list-group mt-2">
                                        <ReactSortable list={item.sub_menus} setList={(newSubMenus) => {
                                            item.sub_menus = newSubMenus;
                                            setMenuItems([...menuItems]);
                                        }} group="nested" animation={200}>
                                            {item.sub_menus.map((subItem, subIndex) => (
                                                <li key={subItem.id} className="list-group-item ms-3">
                                                    <div className="d-flex justify-content-between align-items-center">
                                                        <span>{subItem.name}</span>
                                                        <button className="btn btn-sm btn-warning me-2" onClick={() => setEditingItem(subItem)}>
                                                            <FaEdit />
                                                        </button>
                                                    </div>
                                                </li>
                                            ))}
                                        </ReactSortable>
                                    </ul>
                                )}
                            </div>
                        ))}
                    </ReactSortable>
                </div>
            </div>

            {/* Cột phải: Actions */}
            <div className="col-md-3">
                <h5>Actions</h5>
                <div className="card p-3">
                    <button className="btn btn-primary w-100 mb-2" onClick={saveMenu}>Save Menu</button>
                    <button className="btn btn-success w-100 mb-2">Publish</button>
                </div>
            </div>
        </div>
    );
};

export default AdminMenu;
