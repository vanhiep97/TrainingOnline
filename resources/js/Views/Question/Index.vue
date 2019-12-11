<template>
    <el-row>
        <el-header class="card-head">
            <h3>Ngân hàng đề thi</h3>
            <el-button size="mini" type="success">
                <router-link class="button-create" tag="a" :to="{name: 'form'}">Thêm câu hỏi</router-link>
            </el-button>
        </el-header>
        <el-card>
            <el-table
                :data="tableData.filter(data => !search || data.name.toLowerCase().includes(search.toLowerCase()))"
                style="width: 100%">
                <el-table-column
                    label="STT"
                    prop="question_index" min-width="30">
                </el-table-column>
                <el-table-column
                    label="Câu hỏi"
                    prop="question_name" min-width="150">
                </el-table-column>
                <el-table-column
                    label="Đáp án"
                    prop="question_ask" min-width="60">
                </el-table-column>
                <el-table-column
                    label="Ngày tạo"
                    prop="created_at" min-width="50">
                </el-table-column>
                <el-table-column
                    label="Ngày cập nhật"
                    prop="updated_at" min-width="50">
                </el-table-column>
                <el-table-column
                    align="right">
                    <template slot="header" slot-scope="scope">
                        <el-input
                            v-model="search"
                            size="mini"
                            placeholder="Tìm kiếm câu hỏi"/>
                    </template>
                    <template slot-scope="scope">
                        <el-button
                            size="mini"
                            @click="handleEdit(scope.$index, scope.row)">Sửa
                        </el-button>
                        <el-button
                            size="mini"
                            type="danger"
                            @click="handleDelete(scope.$index, scope.row)">Xóa
                        </el-button>
                    </template>
                </el-table-column>
            </el-table>
        </el-card>
    </el-row>
</template>

<script>
    export default {
        data() {
            return {
                tableData: [
                    {
                        question_index: '1',
                        question_name: 'Tính chất kế thừa OOP biểu thị trong cột nào đúng nhất?',
                        question_ask: 'A',
                        created_at: '1/10/2019',
                        updated_at: '1/10/2019'
                    },
                    {
                        question_index: '1',
                        question_name: 'Tính chất kế thừa OOP biểu thị trong cột nào đúng nhất?',
                        question_ask: 'A',
                        created_at: '1/10/2019',
                        updated_at: '1/10/2019'
                    },
                    {
                        question_index: '1',
                        question_name: 'Tính chất kế thừa OOP biểu thị trong cột nào đúng nhất?',
                        question_ask: 'A',
                        created_at: '1/10/2019',
                        updated_at: '1/10/2019'
                    },
                    {
                        question_index: '1',
                        question_name: 'Tính chất kế thừa OOP biểu thị trong cột nào đúng nhất?',
                        question_ask: 'A',
                        created_at: '1/10/2019',
                        updated_at: '1/10/2019'
                    },
                    {
                        question_index: '1',
                        question_name: 'Tính chất kế thừa OOP biểu thị trong cột nào đúng nhất?',
                        question_ask: 'A',
                        created_at: '1/10/2019',
                        updated_at: '1/10/2019'
                    },
                ],
                search: '',
            }
        },
        methods: {
            handleEdit(index, row) {
                console.log(index, row);
            },
            handleDelete(index, row) {
                console.log(index, row);
            }
        },
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
