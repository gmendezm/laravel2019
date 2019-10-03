/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

// Autoscroll for the chat
import Vue from 'vue'
import VueChatScroll from 'vue-chat-scroll'
import Echo from 'laravel-echo';
Vue.use(VueChatScroll)

import Toaster from 'v-toaster'
import 'v-toaster/dist/v-toaster.css'

Vue.use(Toaster, {timeout: 5000})


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('message', require('./components/chat/message.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 
const app = new Vue({
    el: '#app',
    data: {
        message: '',
        chat:{
            message: [],
            user: [],
            color: [],
            time: []
        },
        typing: '',
        usersInChat: 0
    },
    mounted(){
        window.Echo.private('my_chat_channel')
        .listen('ChatEvent', (e) => {
            this.chat.message.push(e.message);
            this.chat.user.push(e.user);
            this.chat.color.push("warning");
            this.chat.time.push(e.time);
        }).listenForWhisper('typing', (e) => {
            if(e.name != ''){
                this.typing = e.user_writting + " is writting...";
            }else{
                this.typing = '';
            }
        });

        window.Echo.join('my_chat_channel')
        .here((users) => {
            this.usersInChat = users.length;
        })
        .joining((user) => {
            this.usersInChat += 1;
            this.$toaster.success(user.name + 'has joined to the chat room.');
        })
        .leaving((user) => {
            this.usersInChat -= 1;
            this.$toaster.warning(user.name + 'has left the chat room.');
        });
    },
    watch: {
        message(){
          window.Echo.private('my_chat_channel')
          .whisper('typing', {
              name: this.message,
              user_writting:  user["\u0000*\u0000attributes"].name
          });
        }
     },
    methods:{
       
        send(){
            if(this.message.length != 0){
                var date = (new Date()).toString();;
                this.chat.message.push(this.message);
                this.chat.user.push("Tu");
                this.chat.color.push("success");
                this.chat.time.push(date);
                axios.post('/send', {
                    message: this.message,
                    time: date
                })
                .then(response => {
                    console.log("Message received in the server.");
                    this.message = "";
                })
                .catch(error => {
                    console.log(error)
                });
            }
        },

    },

});
