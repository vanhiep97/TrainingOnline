<template>
    <el-row>
        <el-header class="card-head">
            <h3>Tạo bộ câu hỏi</h3>
        </el-header>
        <el-card>
            <el-form :rules="rules" label-width="120px" class="demo-ruleForm">
                <el-form-item label="Câu hỏi" prop="question_name">
                    <el-input type="textarea" v-model="question_name"></el-input>
                </el-form-item>
                <el-form-item label="Đáp án" prop="radio">
                    <el-radio v-model="row.radio" label="1" v-for="(row, index) in rows" :key="index">Option A</el-radio>
                    <el-button type="primary" @click="addRow()">Thêm</el-button>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="submitForm('ruleForm')">Tạo câu hỏi</el-button>
                    <el-button @click="resetForm('ruleForm')">Đặt lại</el-button>
                </el-form-item>
            </el-form>
        </el-card>
    </el-row>
</template>
<script>
    export default {
        data() {
            return {
                question_name: '',
                rows: [
                    {
                        key: 1,
                        radio: 1,
                    }
                ],
                rules: {
                    course_name: [
                        { required: true, message: 'Please input Activity name', trigger: 'blur' },
                        { min: 3, max: 5, message: 'Length should be 3 to 5', trigger: 'blur' }
                    ],
                }
            };
        },
        methods: {
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        alert('submit!');
                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            },
            resetForm(formName) {
                this.$refs[formName].resetFields();
            },
            addRow: function() {
                this.rows.push({key: 2, radio: 2});
            },
            deleteRow: function(row) {
                this.rows.$remove(row);
            },
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
