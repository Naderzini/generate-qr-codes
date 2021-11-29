<template>
    <div class="addItem">
        <input type="text" v-model="items.name"/>
        <font-awesome-icon 
            icon="plus-square"
            :class="[ items.name ? 'active' : 'inactive','plus']"
                @click="addItem(),restInput()"
            /> 
            <li v-for="n in names" :key="n">
            {{n}}
            </li>
        <button class="button" @click="generateQrCodes()">Generate</button>
        <button class="button" @click="downloadZip()">Download zip</button>
    </div>
    
</template>
<script>
import listNames from "./listNames"
export default{
    data:function(){
        return{
            items:{
                name:"",
            },
            names:[]
        }
    },
    components:{
        listNames
    },
    methods:{
        addItem(){
            if(this.items.name == ''){
                return;
            }else{
                this.names.push(this.items.name)
            }
        },
         restInput(){
            this.items.name = ''},
        
        generateQrCodes(){
        axios.post("api/generateQrCode",this.names)
        .then(res => console.log(response))
        .catch(err => console.log(err))
        },

        downloadZip(){
        window.location = window.location.origin+'/api/downloadZip';
        this.names = [];
        },
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
    color:#00CE25;
}
.inactive{
    color:#999999;
}
.button{
    margin:5px;
}
</style>