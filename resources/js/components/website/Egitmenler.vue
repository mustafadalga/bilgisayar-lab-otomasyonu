<template>
    <div>
        <div class="row">
            <h1 class="col text-center">Eğitmenler</h1>
        </div>
        <table class="table">
            <thead class="bg-royal-blue text-white">
            <tr >
                <th scope="col">#</th>
                <th scope="col">Eğitmen Adı / Soyadı</th>
                <th scope="col">Eğitmen Email</th>
                <th scope="col">Seçenekler</th>
            </tr>
            </thead>
            <tbody  v-if="egitmenler && egitmenler.length>0" >
                <tr v-for="(egitmen,index) in egitmenler">
                    <th scope="row">{{ index+1 }}</th>
                    <td>{{ egitmen.adi  }} {{egitmen.soyadi }}</td>
                    <td>{{ egitmen.email }}</td>
                    <td>
                        <a :href="'/egitmen/'+egitmen.slug" class="btn btn-info btn-sm text-white"><i class="fas fa-eye"></i></a>
                    </td>
                </tr>
            </tbody>
            <tbody v-else class="text-center">
            <tr>
                <td colspan="4">
                    <h1 >Eğitmen Bulunmamaktadır.</h1>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    name: "Egitmenler",
    props:['egitmenler'],
}
</script>

<style scoped>

</style>
