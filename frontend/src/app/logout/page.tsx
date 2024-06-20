"use client"

import React, { useEffect } from 'react'
import { useRouter } from 'next/navigation'
import http from '@/lib/axios'
import { useAuth } from '@/context/AuthContext';

const LogoutPage = () => {
  const router = useRouter()
  const {user, loading, setUser} = useAuth()

  useEffect(() => {
    const logout = async () => {

      await http.post('/api/logout').then(() => {
        console.log("logged out")
        setUser(null) // ユーザー状態をリセット
        router.push('/')
      })
        .catch(error => {
          console.error('Logout error:', error)
        })
    }

    logout()
  }, [router])

  return <div>Logging out...</div>
}

export default LogoutPage
