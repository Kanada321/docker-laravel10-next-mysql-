import { AuthProvider } from '@/context/AuthContext'; // パスを適宜変更してください
import LoginForm from '@/components/LoginForm'; // パスを適宜変更してください
import Header from '@/components/Header'; // パスを適宜変更してください

function App() {
  return (
    <AuthProvider>
      <Header />
      <LoginForm />
    </AuthProvider>
  );
}

export default App;
