

import React, { useEffect, useState } from 'react';

const StatusTable = () => {
    const [tarefas, setTarefas] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        fetch('/api/tarefas') // rota no api.php brow
            .then(response => response.json())
            .then(data => {
                setTarefas(data.data);
                setLoading(false);
            })
            .catch(error => console.error('Erro:', error));
    }, []);

    if (loading) return <p>Carregando tarefas...</p>;

    return (
        <div className="table-container">
            <table className="status-table">
                <thead>
                    <tr>
                        <th>Tarefa</th>
                        <th>Prazo</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    {tarefas.map(tarefa => (
                        <tr key={tarefa.id}>
                            <td>{tarefa.tituloTarefa}</td>
                            <td>{new Date(tarefa.prazo).toLocaleDateString('pt-BR')}</td>
                            <td>
                                <span className="status-badge">
                                    {tarefa.status_id === 1 ? 'Pendente' : 'Concluída'}
                                </span>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
            {tarefas.length === 0 && <p>Nenhuma tarefa encontrada.</p>}
        </div>
    );
};

export default StatusTable;