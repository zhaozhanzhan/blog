<template>
    <div class="userpc-content app-main">
        <div class="header ht-flex">
            <div class="refresh" title="刷新">
                <el-button
                    icon="el-icon-refresh"
                    size="small"
                    @click="get"
                ></el-button>
            </div>
        </div>
        <div class="content">
            <el-table
                :data="data"
                v-loading="loading"
                border
                @selection-change="handleSelectionChange"
                style="width: 100%"
            >
                <el-table-column type="selection" fixed align="center">
                </el-table-column>
                <el-table-column type="index" label="#" align="center">
                </el-table-column>
                <el-table-column
                    prop="visitors_num"
                    label="访客量"
                    align="center"
                >
                </el-table-column>
                <el-table-column
                    prop="visits_num"
                    label="访问量"
                    align="center"
                >
                </el-table-column>
                <el-table-column
                    prop="visits_time"
                    label="浏览时长"
                    align="center"
                >
                </el-table-column>
                <el-table-column
                    prop="article_num"
                    label="文章数量"
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
    </div>
</template>

<script>
import { TotalGet } from "@/assets/api/api";
import { SwitchDate } from "@/assets/js/formatTime";
// import { message } from "@/assets/js/message";

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
            TotalGet({
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