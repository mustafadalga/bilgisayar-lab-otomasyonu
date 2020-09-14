<template>
    <div v-if="uyari.status || uyari.message" class="alert text-center" :class="uyari.status ? `alert-${uyari.status}` : 'alert-info'">
        <template v-if="['success','danger'].includes(uyari.status)">
            <template v-for="msg in uyari.message">
                <div>{{ msg.toString() }}</div>
            </template>
        </template>
        <template v-else>
            {{uyari.message}}
        </template>
    </div>
</template>

<script>
export default {
name: "Uyari",
props:['uyari']
}
</script>

<style scoped>

</style>
