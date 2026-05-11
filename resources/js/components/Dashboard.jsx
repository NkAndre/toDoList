import React from 'react';
import './Dashboard.css'; // Vamos criar esse arquivo abaixo

const StatCard = ({ title, value, type }) => (
    <div className={`card card-${type}`}>
        <h3>{title}</h3>
        <p>{value}</p>
    </div>
);

const Dashboard = ({ user, total, pendentes, concluidas, atrasadas }) => {
    return (
        <div className="dashboard-container">
            <header className="dashboard-header">
                <h2>Minhas Tarefas</h2>
                <span className="user-badge">Usuário: <strong>{user}</strong></span>
            </header>

            <div className="dashboard-grid">
                <StatCard title="Total" value={total} type="total" />
                <StatCard title="Pendentes" value={pendentes} type="pending" />
                <StatCard title="Concluídas" value={concluidas} type="completed" />
                <StatCard title="Atrasadas" value={atrasadas} type="delayed" />
            </div>
        </div>
    );
};

export default Dashboard;