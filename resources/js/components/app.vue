<template>
    <div class="container">
        <div class="heading">
            <h2 id="title">Add name to generate Qr Code</h2>
                <add-name/>
        </div>
         
    </div>
</template>
<script>
import addName from "./addName"

export default{
    components:{
        addName,        
    }
}
</script >
<style scoped>
.container{
width:350px;
margin:auto;
}
.heading{
background: #e6e6e6;
padding:10px
}
#title{
text-aligne:center
}
</style>