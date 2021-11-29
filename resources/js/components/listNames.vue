<template>
    <div>
    <li v-for="name in listOfNames" :key="name">
    {{name}}
  </li>
  </div>
</template>
<script>
export default{props:['listOfNames']}
</script>