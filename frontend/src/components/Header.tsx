"use client"

import { useState } from 'react'

const Header = () => {
  const [menuOpen, setMenuOpen] = useState(false)

  const toggleMenu = () => {
    setMenuOpen(!menuOpen)
  }

  return (
    <div className="mx-auto max-w-screen-2xl px-4 md:px-8">
      <header className="flex items-center justify-between py-4 md:py-8">

        <a href="/" className="inline-flex items-center gap-2.5 text-2xl font-bold text-black md:text-3xl"
           aria-label="logo">
          <img
            src="/icon.webp"
            alt="logo"
            width={50}
            height={50}
            className="h-12 w-12 text-amber-400 rounded-full"
          />
          <span className={`zen-kaku-gothic-new-black text-amber-500 relative`}>
    ギルド出席簿
  </span>
        </a>

        <nav className="hidden gap-12 lg:flex">
          <a href="/"
             className="text-lg font-semibold text-gray-600 transition duration-100 hover:text-indigo-500 active:text-indigo-700">
            TOP
          </a>
          <a href="/about"
             className="text-lg font-semibold text-gray-600 transition duration-100 hover:text-indigo-500 active:text-indigo-700">
            About
          </a>
          <a href="#"
             className="text-lg font-semibold text-gray-600 transition duration-100 hover:text-indigo-500 active:text-indigo-700">
            Other
          </a>
        </nav>

        <div className="-ml-8 hidden flex-col gap-2.5 sm:flex-row sm:justify-center lg:flex lg:justify-start">
          <a href="/login"
             className="inline-block rounded-lg px-4 py-3 text-center text-sm font-semibold text-gray-500 outline-none ring-orange-500/75 transition duration-100 hover:text-orange-700 focus-visible:ring active:text-indigo-600 md:text-base">
            ログイン
          </a>

          <a href="/register"
             className="inline-block rounded-lg px-8 py-3 text-center text-sm font-semibold text-white outline-none bg-amber-400/75 transition duration-100 hover:bg-amber-400 focus-visible:ring active:bg-indigo-700 md:text-base">
            新規登録
          </a>
        </div>

        <button type="button" onClick={toggleMenu}
                className="inline-flex items-center gap-2 rounded-lg bg-gray-200 px-2.5 py-2 text-sm font-semibold text-gray-500 ring-indigo-300 hover:bg-gray-300 focus-visible:ring active:text-gray-700 md:text-base lg:hidden">
          <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
            <path fillRule="evenodd"
                  d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                  clipRule="evenodd"/>
          </svg>

          Menu
        </button>
      </header>

      {/* Mobile Menu */}
      {menuOpen && (
        <div className="lg:hidden absolute right-0 top-16 bg-white shadow-lg rounded-lg z-50 w-64">
          <nav className="flex flex-col">
            <a href="/"
               className="text-lg font-semibold text-gray-600 transition duration-100 hover:text-indigo-500 active:text-indigo-700 p-4 active:bg-sky-100 border-b border-gray-300">
              TOP
            </a>
            <a href="/about"
               className="text-lg font-semibold text-gray-600 transition duration-100 hover:text-indigo-500 active:text-indigo-700 p-4 active:bg-sky-100 border-b border-gray-300">
              About
            </a>
            <a href="#"
               className="text-lg font-semibold text-gray-600 transition duration-100 hover:text-indigo-500 active:text-indigo-700 p-4 active:bg-sky-100 border-b border-gray-300">
              Other
            </a>
          </nav>
          <div className="flex flex-col">
            <a href="/login"
               className="text-lg font-semibold text-gray-600 outline-none ring-orange-500/75 transition duration-100 hover:text-orange-700 focus-visible:ring active:text-indigo-600 md:text-base p-4 active:bg-sky-100 border-b border-gray-300">
              ログイン
            </a>
            <a href="/register"
               className="text-lg bg-amber-200 font-semibold text-orange-600 outline-none ring-orange-500/75 transition duration-100 hover:text-amber-700 hover:bg-amber-400 active:bg-amber-400 focus-visible:ring active:text-orange-800 md:text-base p-4 active:bg-sky-100 ">
              新規登録
            </a>
          </div>
        </div>
      )}
    </div>
  )
}

export default Header
