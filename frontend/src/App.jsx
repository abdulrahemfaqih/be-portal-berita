import { BrowserRouter, Routes, Route } from "react-router-dom"
import "./App.css"
import Layout from "./Pages/Layout"
import Home from "./Pages/Home"

export default function App() {

    return (
        <BrowserRouter>
            <Routes>
                <Route path="/" element={<Layout />}>
                    <Route index element={<Home />}></Route>
                </Route>
            </Routes>
        </BrowserRouter>
    )
}
