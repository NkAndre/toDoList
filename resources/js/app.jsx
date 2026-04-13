import './bootstrap';

import './bootstrap';
import React from 'react';
import ReactDOM from 'react-dom/client';
import StatusTable from "./components/statusTable";

if (document.getElementById('react-root')) {
    const root = ReactDOM.createRoot(document.getElementById('react-root'));
    root.render(<StatusTable />);
}
