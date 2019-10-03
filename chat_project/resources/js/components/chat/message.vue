<template>
   <div class="m-2">
        <li class="list-group-item" :class="className" >
            <small>{{ time }}</small><br>
            <slot></slot>
        </li>
        <small class="badge float-right" :class='badgeClass'>{{ user}}</small>
   </div>
</template>

<script>
    export default {
        props: [
            'color',
            'user',
            'time'
        ], 
        computed: {
            className(){
                return 'list-group-item-'+ this.color;
            },
            badgeClass(){
                return 'badge-'  +this.color;
            }
        },
        mounted(){
            console.log("Component mounted.");
        }
    }
</script>