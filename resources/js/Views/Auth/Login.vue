<template>
    <el-row class="row-login">
        <el-card class="card-login">
            <el-header class="card-head">
                <h3>Đăng nhập vào hệ thống</h3>
            </el-header>
            <el-form :model="sendingForm" :rules="rules" ref="sendingForm" label-width="120px" class="demo-ruleForm">
                <el-form-item label="Tài khoản" prop="email">
                    <el-input type="email" placeholder="Nhập vào tài khoản" v-model="sendingForm.email"></el-input>
                </el-form-item>
                <el-form-item label="Mật khẩu" prop="password">
                    <el-input type="password" placeholder="Nhập vào mật khẩu" v-model="sendingForm.password"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="submitForm('sendingForm')">Đăng nhập</el-button>
                </el-form-item>
            </el-form>
        </el-card>
    </el-row>
</template>
<script>
    export default {
        data() {
            return {
                sendingForm: {
                    email: '',
                    password: '',
                },
                rules: {
                    email: [
                        { required: true, message: 'Please input Activity name', trigger: 'blur' },
                        { min: 10, message: 'Tên khóa học phải lớn hơn 10 kí tự', trigger: 'blur' }
                    ],
                }
            };
        },
        methods: {
            submitForm(sendingForm) {
                var input = {
                    email: this.sendingForm.email,
                    password: this.sendingForm.password
                };
                this.$refs[sendingForm].validate((valid) => {
                    if (valid) {
                        axios.post('../api/login',input).then(response => {
                            let token = response.data;
                            if (token) {
                                localStorage.setItem('userToken', token);
                                this.$router.push({name: 'template'});
                                this.sendingForm.email = '';
                                this.sendingForm.password = '';
                            } else {
                                console.log('Token Invalid');
                            }
                        }).catch((err) => {
                            console.log(err);
                        });
                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            },
        }
    }
</script>
<style scoped>
    .row-login {
        width: 100%;
        height: 600px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .card-login {
        width: 600px;
    }

    .card-head {
        background-color: #fff;
    }

    .card-head h3 {
        text-transform: uppercase;
        padding-left: 20px;
    }
</style>
