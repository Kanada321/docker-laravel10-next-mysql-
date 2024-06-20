"use client"

import { ReactNode } from 'react'
import { AuthProvider } from '@/context/AuthContext'
import Header from '@/components/Header'
import Footer from '@/components/Footer'
import "./globals.css"

const Layout = ({children}: { children: ReactNode }) => {
  return (
    <AuthProvider>
      <html lang="en">
      <head>
        <title>My Next.js App</title>
        <meta charSet="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      </head>
      <body>
      <div className="bg-white">
        <Header/>
        <main>{children}</main>
        <Footer/>
      </div>
      </body>
      </html>
    </AuthProvider>
  )
}

export default Layout
