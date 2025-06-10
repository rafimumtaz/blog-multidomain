@extends('layouts.app')

@push('styles')
<style>
    .chat-container { display: flex; flex-direction: column; height: 70vh; }
    .chat-messages { flex-grow: 1; overflow-y: auto; padding: 1rem; border: 1px solid #ddd; margin-bottom: 1rem; }
</style>
@endpush

@section('content')
<div class="container" id="app">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Chatroom Antar Institusi</div>
                <div class="card-body chat-container">
                    <div class="chat-messages" ref="chatMessages">
                        <ul class="list-unstyled">
                            <li v-for="message in messages" :key="message.id">
                                <strong>@{{ message.user.name }} (@{{ message.user.institution.name }})</strong>: @{{ message.message }}
                            </li>
                        </ul>
                    </div>
                    <div class="input-group">
                        <input type="text" v-model="newMessage" @keyup.enter="sendMessage" class="form-control" placeholder="Ketik pesan Anda...">
                        <button class="btn btn-primary" @click="sendMessage">Kirim</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Pengguna Online (@{{ onlineUsers.length }})</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item" v-for="user in onlineUsers" :key="user.id">
                            @{{ user.name }} <span class="badge bg-secondary float-end">@{{ user.institution }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script src="{{ asset('js/app.js') }}"></script>

<script>
    new Vue({
        el: '#app',
        data: { messages: [], newMessage: '', onlineUsers: [] },
        mounted() {
            this.fetchMessages();
            window.Echo.join('chatroom')
                .here(users => this.onlineUsers = users)
                .joining(user => this.onlineUsers.push(user))
                .leaving(user => this.onlineUsers = this.onlineUsers.filter(u => u.id !== user.id))
                .listen('NewChatMessage', e => {
                    this.messages.push(e.message);
                    this.scrollToBottom();
                });
        },
        methods: {
            fetchMessages() {
                axios.get("{{ route('chat.fetch', ['institution' => request()->route('institution')]) }}")
                    .then(response => {
                        this.messages = response.data;
                        this.scrollToBottom();
                    });
            },
            sendMessage() {
                if(this.newMessage.trim() === '') return;
                axios.post("{{ route('chat.send', ['institution' => request()->route('institution')]) }}", { message: this.newMessage });
                this.messages.push({
                    message: this.newMessage,
                    user: { name: '{{ Auth::user()->name }}', institution: { name: '{{ Auth::user()->institution->name }}' } }
                });
                this.newMessage = '';
                this.scrollToBottom();
            },
            scrollToBottom() {
                this.$nextTick(() => {
                    const container = this.$refs.chatMessages;
                    container.scrollTop = container.scrollHeight;
                });
            }
        }
    });
</script>
@endsection