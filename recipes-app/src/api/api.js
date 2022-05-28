/* eslint-disable */
import axios from "axios";

const PORT = 8000;
const baseURL = `http://127.0.0.1:${PORT}/api`;

axios.defaults.headers.common["Content-Type"] = "application/json-patch+json";

const config = () => {
    const token = localStorage.getItem('token');
    return {
        headers: {
            Authorization: `Bearer ${token}`
        }
    };
};

export default {
    auth(){
        return {
            register: (userObj) => axios.post(`${baseURL}/auth/register`, userObj),
            login: (userObj) => axios.post(`${baseURL}/auth/login`, userObj),
            logout: () => axios.post(`${baseURL}/auth/logout`, {},config())
        };
    }
}