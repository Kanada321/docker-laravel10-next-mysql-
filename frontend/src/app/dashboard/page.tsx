"use client";

import useAuth from '@/hooks/useAuth';

const DashboardPage = () => {
    const user = useAuth();

    if (!user) {
        return <div>Loading...</div>;
    }

    return (
        <div>
            <h1>Dashboard</h1>
            <p>Welcome, {user.userId}</p>
        </div>
    );
};

export default DashboardPage;
