import React, { useEffect, useState } from 'react';

export default function ListaTarefas() {
    const [tarefas, setTarefas] = useState([]);

    useEffect(() => {
        // Chamada para a rota que você criou no api.php
        fetch('/api/tarefas')
            .then(response => response.json())
            .then(json => {
                if (json.success) {
                    setTarefas(json.data);
                }
            })
            .catch(error => console.error('Erro ao buscar tarefas:', error));
    }, []);

    return (
        <div style={{ padding: '20px' }}>
            <h1>Minhas Tarefas</h1>
            <ul>
                {tarefas.map(tarefa => (
                    <li key={tarefa.id}>
                        {tarefa.tituloTarefa} - 
                        <strong> {tarefa.status_id === 1 ? 'Pendente' : 'Concluído'}</strong>
                    </li>
                ))}
            </ul>
        </div>
    );
}