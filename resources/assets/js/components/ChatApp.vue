<template>
<div class="card">
    <div class="chatboxInner" style="background-color: rgb(0, 0, 0); opacity: 1;">
        <div  class="user-information-div">
           
        </div>
        <div  class="icon-div">
            <img title="Kapat" src="https://gcdn.bionluk.com/site/icon/tansel_chat_head_close.svg" class="chatbox-icons">
        </div>
    </div>
  <div class="card-body chat-app">
        <Conversation :contact="selectedContact" :messages="messages" @new="saveNewMessage"/>
        <!--  <ContactsList :contacts="contacts" @selected="startConversationWith"/>  -->
  </div>
</div>
</template>

<script>
    import Conversation from './Conversation';
    import ContactsList from './ContactsList';

    export default {
        props: {
            user: {
                type: Object,
                required: true
            },
             konuswith: {
               type: Number,
               required: true
             }
        },
        data() {
            return {
                selectedContact: null,
                messages: [],
                contacts: []
            };
        },
        mounted() {
            this.basla(this.konuswith);

            Echo.private(`messages.${this.user.id}`)
                .listen('NewMessage', (e) => {
                    this.hanleIncoming(e.message);
                });

            axios.get('/contacts')
                .then((response) => {
                    this.contacts = response.data;
                });
        },
        methods: {
            basla(id){
                axios.get(`/getuser/${id}`)
                    .then((response) => {
                     //   console.log(response.data);
                        this.selectedContact = response.data[0];
                        this.startConversationWith(this.selectedContact);
                    });
                
            },
            startConversationWith(contact) {
                this.updateUnreadCount(contact, true);

                axios.get(`/conversation/${contact.id}`)
                    .then((response) => {
                        this.messages = response.data;
                        this.selectedContact = contact;
                    })
            },
            saveNewMessage(message) {
                this.messages.push(message);
            },
            hanleIncoming(message) {
                if (this.selectedContact && message.from == this.selectedContact.id) {
                    this.saveNewMessage(message);
                    return;
                }

                this.updateUnreadCount(message.from_contact, false);
            },
            updateUnreadCount(contact, reset) {
                this.contacts = this.contacts.map((single) => {
                    if (single.id !== contact.id) {
                        return single;
                    }

                    if (reset)
                        single.unread = 0;
                    else
                        single.unread += 1;

                    return single;
                })
            }
        },
        components: {Conversation, ContactsList}
    }
</script>


<style lang="scss" scoped>
.card {
    width: 375px;
    z-index: 100;
    position: fixed;
    bottom: 0;
    right: 260px;
    background-color: #fff;
    -webkit-box-shadow: 0 5px 10px 0 rgba(0,0,0,.2);
    box-shadow: 0 5px 10px 0 rgba(0,0,0,.2);
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;


}
.chatboxInner, .user-information-div{

    display: flex;
    height: 50px;
    background-color: #2d3640;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    border: none;
    -webkit-box-shadow: rgba(0,0,0,.1) 0 5px 10px 0;
   
}
.user-information-div{
    font-size: 16px;
    font-weight: 500;
    color: #fff;
    margin-left: 20px;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
    -ms-flex-direction: row;
    flex-direction: row;
}
.icon-div{
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    padding-right: 20px;
}
.chat-app {

    height: 600px;
    width: 350px;
    position: relative;
    bottom: 0;
    margin: auto 10px 0px;
}
</style>
