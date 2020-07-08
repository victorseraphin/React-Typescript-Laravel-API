import React, { useState } from 'react';
import { RouteComponentProps, withRouter, useHistory, Link } from 'react-router-dom';
import { createStyles, makeStyles, Theme } from '@material-ui/core/styles';
import { TextField, Button } from '@material-ui/core';
import { Input } from 'antd';
import { authenticationService } from '../../_services';
const useStyles = makeStyles((theme: Theme) =>
  createStyles({
    root: {
      '& .MuiTextField-root': {
        margin: theme.spacing(1),
        width: 200,
        display: "block"
      },
    },
    wrapper: {
      width: "100%",
    },
    formInput: {
      width: "100%"
    },
    button: {
      margin: theme.spacing(1),
    },
  }),
);

export interface IValues {
  email: string,
  password: string,
}
export interface IFormState {
  [key: string]: any;
  values: IValues[];
  submitSuccess: boolean;
  loading: boolean;
}
const defaultValues: IValues = {
  email: "",
  password: "",
}

function LoginPage<RouteComponentProps>() {
  const [values, setValues] = useState(defaultValues as IValues);

  const classes = useStyles();
  const history = useHistory();

  const handleChange = (event: any) => {
    event.persist();
    setValues(values => ({
      ...values,
      [event.target.name]: event.target.value
    }));
  }

  const handleSubmit = (event: any) => {
    event.persist();
    authenticationService.login(values.email, values.password)
    .then(data => [
      history.push('/')
    ]);    
  }

  return (
    <div className="site-layout-content">

      <Input.Group>
        <label>Email</label>
        <Input type="text" name="email" defaultValue={values.email} onChange={handleChange} />
      </Input.Group>

      <Input.Group>
        <label>Password</label>
        <Input type="text" name="password" defaultValue={values.password} onChange={handleChange} />
      </Input.Group>

      <Button
        variant="contained"
        color="primary"
        size="large"
        className={classes.button}
        onClick={handleSubmit}
      >
        Login
      </Button>
      <Link to="/register">Cadastra-se</Link>
    </div>
  )
}

export default withRouter(LoginPage);