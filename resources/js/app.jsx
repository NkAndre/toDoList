import './bootstrap';

import './bootstrap';
import React from 'react';
import ReactDOM from 'react-dom/client';
import StatusTable from "./components/statusTable";
import Dashboard from './components/Dashboard';

if (document.getElementById('react-root')) {
    const root = ReactDOM.createRoot(document.getElementById('react-root'));
    root.render(<StatusTable />);
}

const el = document.getElementById('dashboard-root');
if (el) {
    // Pegamos os dados passados via data-attributes no HTML
    const props = Object.assign({}, el.dataset);
    const root = ReactDOM.createRoot(el);
    root.render(<Dashboard {...props} />);
}
