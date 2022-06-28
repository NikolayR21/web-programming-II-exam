/* eslint-disable */
import axios from "axios";

const PORT = 8000;
// const baseURL = `http://127.0.0.1:${PORT}/api`;
const baseURL = `https://heroku-recipes-api.herokuapp.com/api`; 

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
    },
    user(){
        return {
            getProfile: () => axios.get(`${baseURL}/profile`, config())
        };
    },
    recipe(recipeId){
        return {
            getRecipes: () => axios.get(`${baseURL}/recipes`),
            getRecipe: () => axios.get(`${baseURL}/recipes/${recipeId}`),
        }
    },
    ingredients(){
        return {
            getIngredients: () => axios.get(`${baseURL}/ingredients`)
        }
    },
}