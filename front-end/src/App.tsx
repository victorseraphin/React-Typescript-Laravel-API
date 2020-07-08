import React from 'react';
import './App.css';
import { Link, Router, Route } from 'react-router-dom';
import { history } from './_helpers';
import { authenticationService } from './_services';
import { PrivateRoute } from './_components';
import CreateProduct from './pages/products/CreateProduct';
import Products from './pages/products/Products';
import EditProduct from './pages/products/EditProduct';
import LoginPage from './pages/auth/LoginPage';
import RegisterPage from './pages/auth/RegisterPage';
import { Layout, Menu } from 'antd';

const { Header, Content } = Layout;
type AppState = {
  currentUser: {}
};

class App extends React.Component<{}, AppState> {

  constructor(props: Readonly<{}>) {
    super(props);

    this.state = {
      currentUser: {}
    };
  }

  componentDidMount() {
    authenticationService.currentUser.subscribe(x => this.setState({ currentUser: x }));
  }

  logout() {
    authenticationService.logout();
    history.push('/login');
  }

  render() {
    const currentUser = this.state.currentUser;

    return (
      <Router history={history}>
        {currentUser &&
          <Header>
            <Menu theme="dark" mode="horizontal" defaultSelectedKeys={['1']}>
              <Menu.Item key="1">
                <Link to="/">Produts</Link>
              </Menu.Item>
              <Menu.Item key="2">
                <a onClick={this.logout} className="nav-item nav-link">Logout</a>
              </Menu.Item>
            </Menu>
          </Header>
        }

        <Content style={{ padding: '10px 50px' }}>
          <div className="jumbotron">
            <div className="container">
              <div className="row">
                <div className="col-md-6 offset-md-3">
                  <PrivateRoute exact path="/" component={Products} />
                  <PrivateRoute path={'/product/create'} exact component={CreateProduct} />
                  <PrivateRoute path={'/product/edit/:id'} exact component={EditProduct} />
                  <Route path="/login" component={LoginPage} />
                  <Route path={'/register'} exact component={RegisterPage} />
                </div>
              </div>
            </div>
          </div>
        </Content>
      </Router>

    );
  }
}

export default App;