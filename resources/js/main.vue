<template>

    <div>
        <bridge-notify />
        <app-header/>
            <div class="main-content">
                <router-view></router-view>
                <!-- <index/> -->
            </div>
        <app-footer/>
    </div>

</template>

<script>
    import AppHeader from "./components/Layouts/Header";
    import AppFooter from "./components/Layouts/Footer";
    import Index from "./pages/Index";
    export default{
        components : {
            AppHeader, AppFooter, Index
        }
    }
</script>