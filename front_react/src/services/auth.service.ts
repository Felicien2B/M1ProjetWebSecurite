import axios from "axios";
import IUserProfile from "../types/user.profile";

const API_URL = "http://localhost/M1ProjetWebSecurite";

export const register = (username: string, email: string, password: string) => {
  return axios.post(API_URL + "signup", {
    username,
    email,
    password,
  });
};

export const addProfile = (lastName: string, firstName: string, address: string, phoneNumber: string, email: string, description: string, friends: Array<IUserProfile>) => {
  return axios.post(API_URL + "addProfile", {
    lastName,
    firstName,
    address,
    phoneNumber,
    email,
    description,
    friends
  });
};

export const login = (username: string, password: string) => {
  return axios
    .post(API_URL + "signin", {
      username,
      password,
    })
    .then((response) => {
      if (response.data.accessToken) {
        localStorage.setItem("user", JSON.stringify(response.data));
      }

      return response.data;
    });
};

export const resetPassword = (username: string, email: string, password: string) => {
  return axios.post(API_URL + "resetPassword", {
    username,
    email,
    password,
  });
};

export const logout = () => {
  localStorage.removeItem("user");
};

export const getCurrentUser = () => {
  const userStr = localStorage.getItem("user");
  if (userStr) return JSON.parse(userStr);

  return null;
};