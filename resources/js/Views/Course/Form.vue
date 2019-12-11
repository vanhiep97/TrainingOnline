<template>
    <el-row>
        <el-header class="card-head">
            <h3>Thêm mới khóa học</h3>
        </el-header>
        <el-card>
            <el-form :model="sendingForm" :rules="rules" ref="sendingForm" label-width="120px" class="demo-ruleForm" enctype="multipart/form-data">
                <el-form-item label="Image" prop="course_image">
                    <img :src="sendingForm.course_image" class="img-responsive" height="70" width="90"/>
                </el-form-item>
                <el-form-item label="Image" prop="course_image">
                    <input type="file" v-on:change="onImageChange"/>
                </el-form-item>
                <el-form-item label="Social Image" prop="course_social_image">
                    <input type="file" v-on:change="onSocialImageChange"/>
                </el-form-item>
                <el-form-item label="Tên khóa học" prop="course_name">
                    <el-input v-model="sendingForm.course_name"></el-input>
                </el-form-item>
                <el-form-item label="Slug khóa học" prop="course_slug">
                    <el-input v-model="sendingForm.course_slug"></el-input>
                </el-form-item>
                <el-form-item label="Giáo viên dạy" prop="course_teacher">
                    <el-select v-model="sendingForm.course_teacher" placeholder="Chọn giáo viên">
                        <el-option label="Phạm Văn Khôi" value="1"></el-option>
                        <el-option label="Phạm Văn A" value="2"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="Danh mục" prop="course_type">
                    <el-select v-model="sendingForm.course_type" placeholder="Danh mục khóa học">
                        <el-option label="Lập trình Web" value="1"></el-option>
                        <el-option label="Tiếng Nhật" value="2"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="Intro khóa học" prop="course_intro">
                    <el-input type="textarea" v-model="sendingForm.course_intro"></el-input>
                </el-form-item>
                <el-form-item label="Mô tả khóa học" prop="course_description">
                    <el-input type="textarea" v-model="sendingForm.course_description"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="submitForm('sendingForm')">Tạo khóa học</el-button>
                    <el-button @click="resetForm('sendingForm')">Đặt lại</el-button>
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
                    course_social_image: '',
                    course_image: '',
                    course_name: '',
                    course_slug: '',
                    course_teacher: '',
                    course_type: '',
                    course_intro: '',
                    course_description: ''
                },
                rules: {
                    course_name: [
                        { required: true, message: 'Please input Activity name', trigger: 'blur' },
                        { min: 10, message: 'Tên khóa học phải lớn hơn 10 kí tự', trigger: 'blur' }
                    ],
                }
            };
        },
        methods: {
            onImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.sendingForm.course_image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            onSocialImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createSocialImage(files[0]);
            },
            createSocialImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.sendingForm.course_social_image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            submitForm(sendingForm) {
                var input = {
                    social_image: this.sendingForm.course_social_image,
                    image: this.sendingForm.course_image,
                    name: this.sendingForm.course_name,
                    slug: this.sendingForm.course_slug,
                    teacher_id: this.sendingForm.course_teacher,
                    type: this.sendingForm.course_type,
                    intro: this.sendingForm.course_intro,
                    description: this.sendingForm.course_description,
                };
                const config = { headers: { 'Content-Type': 'multipart/form-data' } };
                this.$refs[sendingForm].validate((valid) => {
                    if (valid) {
                        console.log(input);
                        axios.post('../api/createCourse',input,config).then(response => {

                        }).catch((err) => {
                            console.log(err);
                        });
                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            },
            resetForm(sendingForm) {
                this.$refs[sendingForm].resetFields();
            }
        }
    }
</script>
<style scoped>
    .el-row {
        width: 100%;
    }
    .button-create {
        color: #fff;
        font-size: 15px;
        text-decoration: none;
    }
    .card-head {
        background: #e9e4e4;
        padding: 10px 15px !important;
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 50px !important;
    }
    .card-head h3 {
        margin: 0;
        text-align: left;
        text-transform: uppercase;
        font-size: 14px;
        font-weight: bold;
    }
    .el-card {
        border-radius: 0 !important;
    }
</style>
