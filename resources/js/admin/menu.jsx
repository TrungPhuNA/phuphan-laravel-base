import { createRoot } from 'react-dom/client';
import AdminMenu from './components/AdminMenu.jsx';

document.addEventListener("DOMContentLoaded", () => {
    const menuContainer = document.getElementById("admin-menu");

    if (menuContainer) {
        const root = createRoot(menuContainer);
        root.render(<AdminMenu />);
    }
});