<template>
    <el-row>
        <el-header class="header-main">
            <span class="logo">SUNTECH VIỆT NAM</span>
            <el-dropdown>
                <span class="el-dropdown-link">
                 Xin chào: Admin<i class="el-icon-arrow-down el-icon--right"></i>
                </span>
                <el-dropdown-menu slot="dropdown">
                    <el-dropdown-item icon="el-icon-plus" @click="logout()">Đăng xuất</el-dropdown-item>
                </el-dropdown-menu>
            </el-dropdown>
        </el-header>
        <el-container class="main">
            <el-aside class="menu">
                <el-menu default-active="2" class="el-menu-vertical-demo">
                    <el-submenu index="1" collapse-transition="true">
                        <template slot="title">
                            <i class="el-icon-menu"></i>
                            <span>Học online</span>
                        </template>
                        <el-menu-item index="1-2">
                            <i class="el-icon-check"></i>
                            <router-link :to="{name: 'course'}"><span>Khóa học online</span></router-link>
                        </el-menu-item>
                    </el-submenu>
                    <el-submenu index="2">
                        <template slot="title">
                            <i class="el-icon-menu"></i>
                            <span>Luyện thi online</span>
                        </template>
                        <el-menu-item index="2-1">
                            <i class="el-icon-check"></i>
                            <span>Quản lý danh mục</span>
                        </el-menu-item>
                        <el-menu-item index="2-2">
                            <i class="el-icon-check"></i>
                            <router-link :to="{name: 'question'}"><span>Ngân hàng đề thi</span></router-link>
                        </el-menu-item>
                        <el-menu-item index="2-3">
                            <i class="el-icon-check"></i>
                            <span>Quản lý thành viên</span>
                        </el-menu-item>
                    </el-submenu>
                    <el-submenu index="3">
                        <template slot="title">
                            <i class="el-icon-setting"></i>
                            <span>Hệ thống</span>
                        </template>
                        <el-menu-item index="3-1">
                            <i class="el-icon-check"></i>
                            <span>Quản lý danh mục</span>
                        </el-menu-item>
                        <el-menu-item index="3-2">
                            <i class="el-icon-check"></i>
                            <span>Ngân hàng đề thi</span>
                        </el-menu-item>
                        <el-menu-item index="3-3">
                            <i class="el-icon-check"></i>
                            <span>Quản lý thành viên</span>
                        </el-menu-item>
                    </el-submenu>
                </el-menu>
            </el-aside>
            <el-main class="content">
                <el-container>
                    <router-view></router-view>
                </el-container>
            </el-main>
        </el-container>
    </el-row>
</template>

<script>
    export default {
        data() {
            return {}
        },
        methods: {
            logout: function () {
                axios.post('../api/logout').then(response => {
                    localStorage.removeItem('userToken');
                    this.$router.push({name: 'login'});
                }).catch((err) => {
                    console.log(err);
                });
            }
        }
    }
</script>

<style scoped>
    .header-main {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .main {
        display: flex;
    }

    .menu {
        width: 250px;
        min-height: 800px;
    }

    .el-menu-vertical-demo {
        min-height: 800px;
    }

    .el-row {
        width: 100%;
    }
</style>
