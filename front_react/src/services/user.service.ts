import axios from "axios";
import authHeader from "./auth-header";

const API_URL = "http://localhost/M1ProjetWebSecurite";

export const getPublicContent = () => {
  return axios.get(API_URL);
};

export const getUserBoard = () => {
  return axios.get(API_URL + "user", { headers: authHeader() });
};
