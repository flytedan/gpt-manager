import { request } from "quasar-ui-danx";

const API_URL = import.meta.env.VITE_API_URL;

export const AuthRoutes = {
	login: (input) => request.post(API_URL + "/login", input)
};
