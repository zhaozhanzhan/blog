import {
    Message
} from 'element-ui';
import store from '../vuex/store';
export function message(code, text, data) {
    store.commit("setBlackTip", `Loading`);
    switch (code) {
        case 1:
            return true;
        case 1000:
            tip(text, "success")
            return true;
        case 1001:
            return true;
        case 1002:
            tip(text, "info");
            return false;
        case 1003:
            tip(text, "warning");
            return false;
        case 1004:
            tip(text, "error");
            return false;
        case 1009:
            store.commit("setBlack", true);
            store.commit("setBlackTip", text);
            return false;
        case 1010:
            store.commit("setBlack", true);
            store.commit("setBlackTip", `异常频繁请求，请于${data}秒后重试！`);
            return false;
    }
}


function tip(text, type) {
    Message({
        showClose: true,
        message: text,
        type: type
    });
}