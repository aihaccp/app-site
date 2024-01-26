<div>
    <div class="container" >
        <div class="chat-container mt-5">
            <!-- Mensagens -->
            <div class="message">
                <div class="user-image">
                    <!-- Imagem do usuário -->
                    <img src="https://aihaccp.com/assets/images/mascote1.png"
                        alt="User">
                </div>
                <div>
                    <strong>Jaleca - Assistente Ai</strong>
                    <div class="message-text shadow">
                        Olá👋!!Não hesite em colocar-me qualquer questão sobre segurança alimentar e HACCP de acordo com as regras da União Europeia
                    </div>
                </div>
            </div>
            @foreach ($messages as $message)
                <div class="message">
                    <div class="user-image">
                        <!-- Imagem do usuário -->
                        <img src="{{ $message['type'] === 'user' ? '/images/user.png' : 'https://aihaccp.com/assets/images/mascote1.png' }}"
                            alt="User">
                    </div>
                    <div>
                        <strong>{{ $message['type'] === 'user' ? 'Eu' : 'Jaleca - Assistente Ai' }}</strong>
                        <div class="message-text shadow">
                            {{ $message['text'] }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Barra de Input -->
        <div class="fixed-bottom input-container">
            <div class="d-flex mb-3">
                <textarea wire:loading.attr="disabled" wire:target="sendMessage" class="form-control" placeholder="Digite sua mensagem aqui..." wire:model="inputMessage"></textarea>
                <button class="btn btn-outline-secondary send-button shadow" wire:loading.attr="disabled" wire:click="sendMessage"><i
                        class="fa fa-arrow-up"></i></button>
            </div>
        </div>
    </div>
</div>
