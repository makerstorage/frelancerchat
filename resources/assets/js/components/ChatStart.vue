<template>
    <button type="button" class="btn btn-primary btn-lg" @click="chatStatus">Mesaj Gönder</button>
</template>

<!-- vuex kullandim -->
<script>
    import { mapActions } from 'vuex';

    export default {
        methods: {
            ...mapActions([
                'setChatStatus',
            ]),
            chatStatus(){
                this.setChatStatus(true);
            },
        }
    }
</script>

