<template>
    <div class="userpc-content app-main">
        <div class="header ht-flex">
            <!-- <div>
                <el-input
                    placeholder="标题"
                    size="small"
                    v-model="searchTitle"
                ></el-input>
            </div>
            <div class="search">
                <el-tooltip content="搜索" placement="top">
                    <el-button icon="el-icon-search" size="small"></el-button
                ></el-tooltip>
            </div> -->

            <div class="refresh" title="刷新">
                <el-button
                    icon="el-icon-refresh"
                    size="small"
                    @click="get"
                ></el-button>
            </div>
            <div class="delete" title="删除所选">
                <el-button
                    icon="el-icon-delete"
                    size="small"
                    @click="delAll"
                ></el-button>
            </div>
            <div class="add" title="添加">
                <el-button
                    icon="el-icon-plus"
                    size="small"
                    @click="handleAdd"
                ></el-button>
            </div>
        </div>
        <div class="content">
            <el-table
                :data="data"
                v-loading="loading"
                border
                @selection-change="handleSelectionChange"
                @row-dblclick="handleEdit"
                style="width: 100%"
            >
                <el-table-column type="selection" fixed align="center">
                </el-table-column>
                <el-table-column type="index" label="#" align="center">
                </el-table-column>
                <el-table-column prop="title" label="站名" align="center">
                    <template slot-scope="props">
                        <div :title="props.row.title">
                            {{ props.row.title }}
                        </div>
                    </template>
                </el-table-column>
                <el-table-column
                    prop="site"
                    label="网址"
                    align="center"
                    width="300"
                >
                    <template slot-scope="props">
                        <div class="table-link" :title="props.row.site">
                            <a :href="props.row.site" target="_blank">
                                {{ props.row.site }}</a
                            >
                        </div>
                    </template>
                </el-table-column>
                <el-table-column
                    prop="email"
                    label="邮箱"
                    width="200"
                    align="center"
                >
                </el-table-column>
                <el-table-column
                    prop="visit_num"
                    label="访问次数"
                    width="150"
                    align="center"
                >
                </el-table-column>
                <el-table-column
                    prop="sort"
                    label="权重"
                    width="100"
                    align="center"
                >
                </el-table-column>
                <el-table-column
                    prop="created_at"
                    label="创建时间"
                    width="180"
                    align="center"
                >
                    <template slot-scope="props">
                        {{ formatTime(props.row.created_at) }}
                    </template>
                </el-table-column>
                <el-table-column
                    prop="release"
                    label="发布"
                    width="100"
                    align="center"
                >
                    <template slot-scope="scope">
                        <el-switch
                            @change="release(scope.row.id)"
                            :value="scope.row.release === 1 ? true : false"
                            active-color="#55cbc4"
                        ></el-switch>
                    </template>
                </el-table-column>

                <el-table-column
                    fixed="right"
                    label="操作"
                    width="130"
                    align="center"
                >
                    <template slot-scope="scope">
                        <div class="header ht-flex ht-col-center ht-row-center">
                            <div class="edit" title="编辑">
                                <el-button
                                    icon="el-icon-edit"
                                    size="mini"
                                    @click="handleEdit(scope.row)"
                                ></el-button>
                            </div>
                            <div class="delete" title="删除">
                                <el-button
                                    icon="el-icon-delete"
                                    size="mini"
                                    @click="delCurrent(scope.row.id)"
                                ></el-button>
                            </div>
                        </div>
                    </template>
                </el-table-column>
            </el-table>
            <div class="paging ht-flex ht-row-right">
                <el-pagination
                    background
                    layout="total,sizes,prev,pager, next"
                    :total="total"
                    :page-sizes="[15, 35, 50, 100]"
                    @current-change="handleCurrentPage"
                    @size-change="handlePageSize"
                >
                </el-pagination>
            </div>
        </div>
        <el-dialog
            :visible.sync="dialogVisible"
            :modal="true"
            :show-close="false"
            :close-on-click-modal="false"
            :modal-append-to-body="false"
            :fullscreen="fullscreen"
            top="0"
            :custom-class="fullscreen ? '' : 'el-dialog-fullscreen'"
        >
            <div slot="title" class="el-dialog-header">
                <div class="title-left">{{ editFlag ? "编辑" : "添加" }}</div>
                <div class="title-right">
                    <i
                        :title="fullscreen ? '最小化' : '最大化'"
                        class="iconfont icon-Batchfolding"
                        @click="fullscreen = !fullscreen"
                    ></i>
                    <i
                        title="关闭"
                        class="iconfont icon-close"
                        @click="dialogVisible = false"
                    ></i>
                </div>
            </div>
            <div class="dialog-contnet">
                <div class="item">
                    <div class="left">名称：</div>
                    <div class="right">
                        <el-input
                            v-model="title"
                            maxlength="30"
                            show-word-limit
                            @keyup.enter.native="confirm"
                        ></el-input>
                    </div>
                </div>
                <div class="item">
                    <div class="left">链接：</div>
                    <div class="right">
                        <el-input
                            v-model="site"
                            maxlength="70"
                            show-word-limit
                            @keyup.enter.native="confirm"
                        ></el-input>
                    </div>
                </div>
                <div class="item">
                    <div class="left">邮箱：</div>
                    <div class="right">
                        <el-input
                            v-model="email"
                            maxlength="40"
                            show-word-limit
                            @keyup.enter.native="confirm"
                        ></el-input>
                    </div>
                </div>
                <div class="item">
                    <div class="left">访问量：</div>
                    <div class="right">
                        <el-input
                            v-model="visit_num"
                            type="number"
                            @keyup.enter.native="confirm"
                        ></el-input>
                    </div>
                </div>
                <div class="item">
                    <div class="left">权重：</div>
                    <div class="right">
                        <el-input
                            type="number"
                            v-model="sort"
                            min="0"
                            max="127"
                            placeholder="升序(0~127之间)"
                            @keyup.enter.native="confirm"
                        ></el-input>
                    </div>
                </div>
                <div class="item">
                    <div class="left">创建时间：</div>
                    <div class="right">
                        <el-date-picker
                            v-model="created_at"
                            type="date"
                            placeholder="选择日期"
                            format="yyyy 年 MM 月 dd 日"
                            value-format="timestamp"
                        >
                        </el-date-picker>
                    </div>
                </div>
            </div>
            <div slot="footer">
                <el-button size="small" @click="clear">重置</el-button>
                <el-button size="small" @click="confirm">确定</el-button>
            </div>
        </el-dialog>
    </div>
</template>

<script>
import {
    LinkGet,
    LinkAdd,
    LinkEdit,
    LinkDel,
    LinkRelease,
} from "@/assets/api/api";
import { SwitchDate } from "@/assets/js/formatTime";
import { message } from "@/assets/js/message";
import { checkEmail, checkWebsite } from "@/assets/js/reg";

export default {
    name: "TypeList",
    data() {
        return {
            dialogVisible: false,
            fullscreen: false,
            loading: true,
            editFlag: false,
            editId: "",
            ids: "",
            data: [],
            start: 1,
            pageSize: 15,
            total: 0,
            title: "",
            // searchTitle: "",
            site: "",
            email: "",
            visit_num: 0,
            sort: 100,
            created_at: Date.now(),
        };
    },
    methods: {
        /**
         * 获取
         */
        get() {
            this.loading = true;
            LinkGet({
                start: (this.start - 1) * this.pageSize,
                pageSize: this.pageSize,
            }).then((res) => {
                if (res) {
                    const { data, total } = res;
                    this.data = data;
                    this.total = total;
                } else {
                    this.data = [];
                    this.total = 0;
                }
                this.loading = false;
            });
        },
        /**
         * 删除所有
         */
        delAll() {
            this.del(this.ids);
        },
        /**
         * 删除当前
         */
        delCurrent(id) {
            this.del(id);
        },
        /**
         * 删除||删除所选
         */
        del(id) {
            this.$msgBox
                .confirm("删除所选, 是否继续?", "提示", {
                    confirmButtonText: "确定",
                    cancelButtonText: "取消",
                    type: "warning",
                })
                .then(() => {
                    if (id === "") {
                        message(1003, "请选择删除内容！");
                        return;
                    }
                    LinkDel({ id: id }).then((res) => {
                        if (res) {
                            this.get();
                        }
                    });
                })
                .catch(() => {});
        },
        /**
         * 添加||编辑
         */
        confirm() {
            if (!this.checkInput()) {
                return;
            }
            if (this.editFlag) {
                this.edit();
            } else {
                this.add();
            }
        },
        /**
         * 添加编辑
         */
        handleAdd() {
            this.dialogVisible = true;
            this.editFlag = false;
            this.clear();
        },
        /**
         * 添加
         */
        add() {
            LinkAdd({
                title: this.title,
                site: this.site,
                email: this.email,
                visit_num: this.visit_num,
                sort: this.sort,
                created_at: parseInt(this.created_at / 1000),
            }).then((res) => {
                if (res) {
                    this.dialogVisible = false;
                    this.get();
                    this.clear();
                }
            });
        },
        /**
         * 检查输入
         */
        checkInput() {
            if (this.title === "") {
                message(1003, "请输入站点名称！");
                return false;
            }
            if (this.site === "") {
                message(1003, "请输入站点地址！");
                return false;
            }
            if (!checkWebsite(this.site)) {
                message(1003, "站点格式错误！");
                return false;
            }
            if (this.email === "") {
                message(1003, "请输入邮箱！");
                return false;
            }
            if (!checkEmail(this.email)) {
                message(1003, "邮箱格式错误！");
                return false;
            }
            this.created_at =
                this.created_at === "" ? Date.now() : this.created_at;
            if (this.sort < 0) {
                this.sort = 0;
            }
            if (this.sort > 100) {
                this.sort = 100;
            }
            return true;
        },
        /**
         * 编辑赋值
         */
        handleEdit(row) {
            this.dialogVisible = true;
            this.editFlag = true;
            this.title = row.title;
            this.site = row.site;
            this.email = row.email;
            this.visit_num = row.visit_num;
            this.sort = row.sort;
            this.editId = row.id;
            this.created_at = Date.parse(new Date(row.created_at));
        },
        /**
         * 编辑
         */
        edit() {
            if (this.editId === "") {
                message(1003, "参数为空或格式错误！");
                return;
            }
            LinkEdit({
                id: this.editId,
                title: this.title,
                site: this.site,
                email: this.email,
                visit_num: this.visit_num,
                sort: this.sort,
                created_at: parseInt(this.created_at / 1000),
            }).then((res) => {
                if (res) {
                    this.get();
                    this.dialogVisible = false;
                }
            });
        },
        /**
         * 发布
         */
        release(id) {
            LinkRelease({ id: id }).then((res) => {
                if (res) {
                    this.get();
                }
            });
        },
        /**
         * 清空
         */
        clear() {
            this.title = "";
            this.site = "";
            this.email = "";
            this.visit_num = 0;
            this.sort = 100;
            this.created_at = Date.now();
        },
        /**
         * 日期转换
         */
        formatTime(time) {
            return SwitchDate(Date.parse(new Date(time)) / 1000);
        },
        handleSelectionChange(data) {
            let ids = "";
            for (let i = 0; i < data.length; i++) {
                ids += `${data[i].id},`;
            }
            this.ids = ids.substring(0, ids.length - 1);
        },
        handleCurrentPage(start) {
            this.start = start;
            this.get();
        },
        handlePageSize(pageSize) {
            this.pageSize = pageSize;
            this.get();
        },
    },
    created() {
        this.get();
    },
};
</script>

<style lang="scss">
</style>