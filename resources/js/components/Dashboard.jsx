import React from 'react';
import { ListTodo, CheckCircle, Clock, AlertCircle } from 'lucide-react';
import './Dashboard.css';

const StatCard = ({ title, value, type, icon: Icon }) => (
    <div className={`stat-card card-${type}`}>
        <div className="stat-content">
            <div className="stat-text">
                <span className="stat-title">{title}</span>
                <h2 className="stat-value">{value}</h2>
            </div>
            <div className="stat-icon-wrapper">
                <Icon size={24} />
            </div>
        </div>
    </div>
);

const Dashboard = ({ user, total, pendentes, concluidas, atrasadas }) => {
    return (
        <div className="dashboard-wrapper">
            <main className="main-content">
                <header className="top-header">
                    <div className="header-info">
                        <h1>Dashboard de Tarefas</h1>
                        <p>Bem-vindo de volta, <strong>{user}</strong></p>
                    </div>
                    <div className="date-display">
                        {new Date().toLocaleDateString('pt-BR')}
                    </div>
                </header>

                <div className="stats-grid">
                    <StatCard title="Total de Tarefas" value={total} type="total" icon={ListTodo} />
                    <StatCard title="Tarefas Pendentes" value={pendentes} type="pending" icon={Clock} />
                    <StatCard title="Concluídas" value={concluidas} type="completed" icon={CheckCircle} />
                    <StatCard title="Atrasadas" value={atrasadas} type="delayed" icon={AlertCircle} />
                </div>

                <div className="content-placeholder">
                    <div className="chart-box">Resumo de Atividade (Gráfico)</div>
                    <div className="list-box">Últimas Atualizações</div>
                </div>
            </main>
        </div>
    );
};

export default Dashboard;