<x-app-layout>
    <style>
        /* Reset básico para o body e html para remover margens/paddings padrão */

        /* Estilos Adicionais */
        .chat-container {
            height: calc(100vh - 6rem);
            /* Altura total da janela menos a altura do input e um pouco de espaço */
            margin: 0 auto;
            padding: 20px;
            overflow-y: auto;
            margin-bottom: 8rem;
            /* Barras de rolagem apenas quando necessário */
        }

        .message {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .user-image {
            width: 50px;
            height: 50px;
            background-color: #f8f9fa;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 10px;
            flex-shrink: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .user-image img {
            width: 100%;
            height: auto;
        }

        .message-text {
            background-color: #f8f9fa;
            padding: 10px;
            min-width: 5rem;
            border-radius: 10px;
            max-width: calc(100% - 70px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* Sombra leve para as mensagens */
        }

        .input-group.fixed-bottom {
            position: fixed;
            bottom: 0;
            left: 15rem;
            margin-left: 10rem;
            padding: 10px 20px;
            /* Espaçamento interno ajustado */
            background-color: #fff;
            z-index: 1030;
            /* Garante que a barra de input fique acima de outros elementos */
        }

        .d-flex textarea {
            margin-right: 3rem;
            margin-left: 17rem;
            resize: none;
            border: none;
            /* Remove a borda do textarea */
            border-radius: 10px 10px 10px 10px;
            max-height: 6rem;
            overflow-y: auto;
            flex-grow: 1;
            padding: 10px;
            /* Espaçamento interno para o texto */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* Sombra leve para a área de input */
        }

        .send-button {
            margin-right: 2rem;
            width: 50px;
            height: 50px;
            border-radius: 10px;
            /* Botão mais arredondado */
            background-color: black;
            /* Cor de fundo azul */
            color: #ffffff;
            /* Texto em branco */
            border: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* Sombra leve para o botão */
        }
    </style>
    @livewire('chatbot')

</x-app-layout>
