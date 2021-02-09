import Vue from "vue"
import Vuex from "vuex"

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        LinkList: [],
        infoDetail: [],
        qq: "",
        email: "",
        avatar: "",
        name: "",
        progress: 0,
        msgFlag: true,
        article_id: 0,
        visitsTime: window.localStorage.getItem("visitsTime"),
        isBlack: false,
        blackTip: "Loading",
        frequentTime: 0,

    },
    mutations: {
        /**
         * 异常请求||黑名单
         */
        setBlack(state, val) {
            state.isBlack = val;
        },
        /**
         * 异常请求||黑名单(提示)
         */
        setBlackTip(state, val) {
            state.blackTip = val;
        },
        /**
         * 异常请求||黑名单(时间)
         */
        setRrequentTime(state, val) {
            state.frequentTime = val;
        },
        /**
         * 浏览时长
         */
        setVisitsTime(state, val) {
            state.visitsTime = val;
            window.localStorage.setItem("visitsTime", val);
        },
        /**
         * 链接列表
         */
        setLinkList(state, val) {
            state.LinkList = val;
        },
        /**
         * 进度条
         */
        setProgress(state, val) {
            state.progress = val;
        },
        /**
         * true文章评论|false留言
         */
        setMsgFlag(state, val) {
            state.msgFlag = val;
        },
        /**
         * 当前文章ID
         */
        setArticleId(state, val) {
            state.article_id = val;
        },
        /**
         * 基本信息
         */
        setInfoDetail(state, val) {
            state.infoDetail = val
        },
        setQQ(state, val) {
            state.qq = val
        },
        setEmail(state, val) {
            state.email = val
        },
        setAvatar(state, val) {
            state.avatar = val
        },
        setName(state, val) {
            state.name = val
        },
    },
    actions: {
        decrementFrequentTime({
            commit,
            state
        }) {
            if (state.frequentTime > 0) {
                setTimeout(() => {
                    commit('increment')
                }, 1000)
            }
            // console.log(commit, state)s

        }
    }

})