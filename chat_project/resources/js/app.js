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
            color: []
        },
        typing: ''
    },
    mounted(){
        window.Echo.private('my_chat_channel')
        .listen('ChatEvent', (e) => {
            this.chat.message.push(e.message);
            this.chat.user.push(e.user);
            this.chat.color.push("warning");
        }).listenForWhisper('typing', (e) => {
            if(e.name != ''){
                this.typing = e.user_writting + " is writting...";
            }else{
                this.typing = '';
            }
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
                this.chat.message.push(this.message);
                this.chat.user.push("Tu");
                this.chat.color.push("success");
                axios.post('/send', {
                    message: this.message
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
