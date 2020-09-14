<template>
    <nav class="navbar navbar-expand navbar-light bg-royal-blue topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-white small">{{ admin }}</span>
                    <i class="fas fa-user-circle fa-2x"></i>
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="/dashboard/ayarlar">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        Ayarlar
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal" @click="logout">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Çıkış Yap
                    </a>
                </div>
            </li>

        </ul>

    </nav>

</template>

<script>
export default {

    name: "Navbar",
    props:['admin'],
    methods: {
        logout() {
            axios.post('/logout',)
                .then(response => {
                    window.location = '/dashboard/login'
                })
                .catch(error => {
                })
        }
    }
}
</script>

<style scoped>

</style>
