import React from 'react';
import { ListTodo, CheckCircle, Clock, AlertCircle } from 'lucide-react';
import ReactECharts from 'echarts-for-react'; // 1. Importa o componente do gráfico
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
    
    // 2. Define a configuração do gráfico adaptada para os seus dados
    const chartOption = {
        tooltip: {
            trigger: 'axis',
            axisPointer: { type: 'shadow' }
        },
        grid: {
            top: '10%',
            left: '5%',
            right: '5%',
            bottom: '10%',
            containLabel: true
        },
        xAxis: {
            type: 'category',
            // Substituímos os dias da semana pelos status das tarefas
            data: ['Pendentes', 'Concluídas', 'Atrasadas'],
            axisLabel: {
                color: '#666'
            }
        },
        yAxis: {
            type: 'value',
            minInterval: 1, // Garante que o gráfico use números inteiros na escala
            axisLabel: {
                color: '#666'
            }
        },
        series: [
            {
                // Inserimos os valores reais que o componente recebe via props
                data: [
                    {
                        value: pendentes,
                        itemStyle: { color: '#f59e0b' } // Cor customizada (ex: Amarelo)
                    },
                    {
                        value: concluidas,
                        itemStyle: { color: '#10b981' } // Cor customizada (ex: Verde)
                    },
                    {
                        value: atrasadas,
                        itemStyle: { color: '#ef4444' } // Cor customizada (ex: Vermelho)
                    }
                ],
                type: 'bar',
                barWidth: '50%', // Ajusta a largura das barras
                borderRadius: [4, 4, 0, 0] 
            }
        ]
    };

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
                    <div className="chart-box">
                        <h3>Resumo de Atividade</h3>
                       
                        <ReactECharts 
                            option={chartOption} 
                            style={{ height: '300px', width: '100%' }} 
                        />
                    </div>
                    <div className="list-box">Últimas Atualizações
                    <ReactECharts 
                            option={chartOption} 
                            style={{ height: '300px', width: '100%' }} 
                        />
                    </div>
                </div>
            </main>
        </div>
    );
};

export default Dashboard;