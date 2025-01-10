import { BrowserRouter, Routes, Route } from "react-router-dom"
import "./App.css"
import Layout from "./Pages/Layout"
import Home from "./Pages/Home"
import Register from "./Pages/Auth/Register"
import Login from "./Pages/Auth/Login"

export default function App() {

    return (
        <BrowserRouter>
            <Routes>
                <Route path="/" element={<Layout />}>
                    <Route index element={<Home />}></Route>

                    <Route path="/register" element={<Register />} />
                    <Route path="/login" element={<Login/>} />
                </Route>
            </Routes>
        </BrowserRouter>
    )
}
