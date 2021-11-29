<template>
    <div class="addItem">
        <input type="text" v-model="items.name"/>
        <font-awesome-icon 
            icon="plus-square"
            :class="[ items.name ? 'active' : 'inactive','plus']"
                @click="addItem(),restInput()"
            /> 
            <list-names v-bind:list-of-nams="names"/>
    </div>
    
</template>
<script>
import listNames from "./listNames"
export default{
    data:function(){
        return{
            items:{
                name:"",
            },names:[]
        }
       
    },
    components:{
        listNames
    },
    methods:{
        addItem(){
            if(this.items.name == ''){
                console.log('test')
            }else{
                this.names.push(this.items.name)
            }
            console.log(this.names)
        },
         restInput(){
            this.items.name = ''}
    }
}
</script>

<style scoped>
.addItem{
    dispaly:flex;
    just-content:center;
    align-item:center;
}
input{
    background: #f7f7f7;
    border:0px;
    outline:none;
    padding:5px;
    margin-right:10px;
    width:85%;
}
.plus{
    color:#00CE25
}
.inactive{
    color:#999999
}
</style>