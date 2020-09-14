<template>
    <div>
        <div class="row text-center">
           <h1 class="col">Dersler</h1>
        </div>
        <table class="table">
            <thead class="bg-royal-blue text-white">
            <tr >
                <th scope="col">#</th>
                <th scope="col">Ders Kodu</th>
                <th scope="col">Ders Adı</th>
                <th scope="col">Kredi</th>
            </tr>
            </thead>
            <tbody v-if="dersler && dersler.length>0" >
            <tr v-for="(ders,index) in dersler">
                <th scope="row">{{index+1}}</th>
                <td>{{ ders.kod }}</td>
                <td>{{ ders.adi }}</td>
                <td>{{ ders.kredi }}</td>
            </tr>
            </tbody>
            <tbody v-else class="text-center">
            <tr>
                <td colspan="4">
                    <h1 >Ders Bulunmamaktadır.</h1>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    name: "Dersler",
    props:['dersler'],
}
</script>

<style scoped>

</style>
