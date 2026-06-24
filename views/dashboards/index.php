    <style>

        .container {
            display: flex;
            flex: 1;
            overflow: hidden;

            /* Centering Logic */
            width: 100%;
            max-width: 1400px; /* Controls how wide the content gets */
            margin: 0 auto;    /* Centers the container horizontally */

            /* Visual polish */
            background-color: white;
            box-shadow: 0 0 20px rgba(0,0,0,0.05); /* Adds a subtle shadow */
            border-left: 1px solid #e0e0e0;
            border-right: 1px solid #e0e0e0;
        }

        aside { width: 260px; background-color: #ffffff; border-right: 1px solid #e0e0e0; display: flex; flex-direction: column; padding-top: 10px; overflow-y: auto; }

        .menu-title { font-size: 0.75rem; color: #888; text-transform: uppercase; font-weight: bold; padding: 15px 20px 10px; letter-spacing: 0.5px; }

        button { background: none; border: none; width: 100%; padding: 12px 20px; text-align: left; cursor: pointer; color: #444; font-size: 0.95rem; transition: 0.2s; outline: none; }
        button:hover { background-color: #f0f0f0; }
        button.active { background-color: #e0f7fa; color: #006064; border-left: 4px solid #0e01c7; font-weight: 600; }

        main { flex: 1; background-color: #fff; position: relative; }
        iframe { width: 100%; height: 100%; border: none; display: block; }
    </style>

    <div class="container">
        <aside>
            <div class="menu-title">Navegue pelos Painéis</div>

            <button class="nav-btn active" onclick="loadDashboard(this, 'https://metabase.cultura.gov.br/public/dashboard/e52c6973-adf2-4494-bf16-a894c0b89fbc')">Agentes - Diagnóstico Sociodemográfico e Diversidade</button>
            <button class="nav-btn" onclick="loadDashboard(this, 'https://metabase.cultura.gov.br/public/dashboard/f02defdf-6934-48f6-a26e-074537c80500')">Agenda Cultural</button>
            <button class="nav-btn" onclick="loadDashboard(this, 'https://metabase.cultura.gov.br/public/dashboard/ccf8418a-03ad-4919-aeba-bfb7279859f0')">Gestão de Fomento e Editais</button>
            <button class="nav-btn" onclick="loadDashboard(this, 'https://metabase.cultura.gov.br/public/dashboard/50fd3415-8c54-4749-abd9-95a98cd61797')">Iniciativas Culturais</button>
            <button class="nav-btn" onclick="loadDashboard(this, 'https://metabase.cultura.gov.br/public/dashboard/bf432615-189e-4e97-b1af-2a895a1cb8ba')">Espaços Culturais</button>
            <button class="nav-btn" onclick="loadDashboard(this, 'https://metabase.cultura.gov.br/public/dashboard/f2110b02-18d5-4fb5-b81b-efd21dc8c9c7')">Monitoramento do Sistema (Operacional)</button>
            <button class="nav-btn" onclick="loadDashboard(this, 'https://metabase.cultura.gov.br/public/dashboard/1f578420-aeea-4109-ac3b-4eae3e80215e')">Comunicação</button>
        </aside>

        <main>
            <iframe id="dashboard-frame" src="https://metabase.cultura.gov.br/public/dashboard/e52c6973-adf2-4494-bf16-a894c0b89fbc" allowtransparency></iframe>
        </main>
    </div>

    <script>
        function loadDashboard(btn, url) {
            const frame = document.getElementById('dashboard-frame');
            if (frame.src !== url) frame.src = url;
            document.querySelectorAll('.nav-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        }
    </script>
