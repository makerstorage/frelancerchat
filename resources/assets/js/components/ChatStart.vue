<template>
    <button type="button" class="btn btn-primary btn-lg" @click="chatStatus">Mesaj Gönder</button>
</template>

<!-- vuex kullandim -->
<script>
    import { mapActions } from 'vuex';

    export default {
        props: {
            id: {
                type: Number,
                required: true
            }
        },
        mounted() {
            this.chatWithId();
        },
        methods: {
            ...mapActions([
                'setChatStatus',
                'setChatWithId',
            ]),
            chatStatus(){
                this.setChatStatus(true);
            },
            chatWithId(){
                this.setChatWithId(this.id);
            }
        }
    }
</script>

