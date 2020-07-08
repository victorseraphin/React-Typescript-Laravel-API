import React, { useState } from 'react';
import axios from 'axios';
import { RouteComponentProps, withRouter, useHistory, Link } from 'react-router-dom';
import { createStyles, makeStyles, Theme } from '@material-ui/core/styles';
import { TextField, Button } from '@material-ui/core';
import SaveIcon from '@material-ui/icons/Save';
import { Input, Select } from 'antd';
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
  name: string,
  email: string,
  password: string,
  password_confirm: string,
}
const defaultValues: IValues = {
  name: "",
  email: "",
  password: "",
  password_confirm: "",
}

function RegisterPage<RouteComponentProps>() {
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

  const handleSubmit = async (event: any) => {
    event.persist();
    await authenticationService.register(values);    
    history.push('/')
  }

  return (
    <div className="site-layout-content">
      <Input.Group>
        <label>Name</label>
        <Input type="text" name="name" defaultValue={values.name} onChange={handleChange} />
      </Input.Group>

      <Input.Group>
        <label>Email</label>
        <Input type="text" name="email" defaultValue={values.email} onChange={handleChange} />
      </Input.Group>

      <Input.Group>
        <label>Password</label>
        <Input type="text" name="password" defaultValue={values.password} onChange={handleChange} />
      </Input.Group>

      <Input.Group>
        <label>Password Confirm</label>
        <Input type="text" name="password_confirm" defaultValue={values.password_confirm} onChange={handleChange} />
      </Input.Group>



      <Button
        variant="contained"
        color="primary"
        size="large"
        className={classes.button}
        startIcon={<SaveIcon />}
        onClick={handleSubmit}
      >
        Cadastrar
      </Button>
      <Link to="/login">Já tenho cadastro</Link>
    </div>
  )
}

export default withRouter(RegisterPage);