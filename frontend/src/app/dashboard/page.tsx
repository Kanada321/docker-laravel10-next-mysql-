"use client"

import useAuth from '@/hooks/useAuth'

const DashboardPage = () => {
  const {user, loading} = useAuth()

  if (loading) {
    return <div>Loading...</div>
  }

  if (!user) {
    return <div>No user found</div>
  }

  return (
    <div>
      <h1>Dashboard</h1>
      <p>Welcome, {user.userId}</p>
    </div>
  )
}

export default DashboardPage
