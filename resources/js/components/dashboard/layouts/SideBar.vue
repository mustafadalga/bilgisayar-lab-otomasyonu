<template>
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
            <div class="sidebar-brand-text mx-3">Yönetici Paneli</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item" :class="getUrl=='/dashboard' ? 'active':''">
            <a class="nav-link" href="/dashboard">
                <i class="fas fa-home"></i>
                <span>Anasayfa</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Menü
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item" :class="getUrl=='/dashboard/dersler' ? 'active':''">
            <a class="nav-link collapsed"   href="/dashboard/dersler" >
                <i class="fas fa-fw fa-book"></i>
                <span>Dersler</span>
            </a>
        </li>
        <li class="nav-item" :class="getUrl=='/dashboard/egitmenler' ? 'active':''">
            <a class="nav-link collapsed"  href="/dashboard/egitmenler" >
                <i class="fas fa-fw fa-chalkboard-teacher"></i>
                <span>Eğitmenler</span>
            </a>
        </li>
        <li class="nav-item" :class="getUrl=='/dashboard/laboratuvarlar' ? 'active':''">
            <a class="nav-link collapsed"  href="/dashboard/laboratuvarlar" >
                <i class="fas fa-network-wired"></i>
                <span>Laboratuvarlar</span>
            </a>
        </li>
        <li class="nav-item" :class="getUrl=='/dashboard/yoneticiler' ? 'active':''">
            <a class="nav-link collapsed"  href="/dashboard/yoneticiler" >
                <i class="fa fa-users" aria-hidden="true"></i>
                <span>Yöneticiler</span>
            </a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">


        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>

</template>

<script>
export default {
    name: "SideBar",
    computed:{
        getUrl:function (){
            return window.location.pathname;
        }
    }
}

</script>

<style scoped>

</style>
