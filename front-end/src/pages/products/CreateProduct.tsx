import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { RouteComponentProps, withRouter, useHistory } from 'react-router-dom';
import { createStyles, makeStyles, Theme } from '@material-ui/core/styles';
import { TextField, Button } from '@material-ui/core';
import SaveIcon from '@material-ui/icons/Save';
import { Input, Select } from 'antd';
import { productService } from '../../_services';
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
  description: string,
  category: string,
  qty: number,
  price: number
}
/*const defaultValues: IValues = {
  name: "",
  description: "",
  category: "",
  qty: 0,
  price: 0
}*/

function CreateProduct<RouteComponentProps>() {
  const [values, setValues] = useState({} as IValues);

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
    await productService.createItem(values);
    history.goBack()
  }

  return (
    <div className="site-layout-content">
      <Input.Group>
        <label>Name</label>
        <Input type="text" name="name" defaultValue={values.name} onChange={handleChange} />
      </Input.Group>

      <Input.Group>
        <label>Description</label>
        <Input type="text" name="description" defaultValue={values.description} onChange={handleChange} />
      </Input.Group>

      <Input.Group>
        <label>Category</label>
        <Input type="text" name="category" defaultValue={values.category} onChange={handleChange} />
      </Input.Group>

      <Input.Group>
        <label>Qty</label>
        <Input type="text" name="qty" defaultValue={values.qty} onChange={handleChange} />
      </Input.Group>

      <Input.Group>
        <label>Price</label>
        <Input type="text" name="price" defaultValue={values.price} onChange={handleChange} />
      </Input.Group>

      <Button
        variant="contained"
        color="primary"
        size="large"
        className={classes.button}
        startIcon={<SaveIcon />}
        onClick={handleSubmit}
      >
        Save
      </Button>
    </div>
  )
}

export default withRouter(CreateProduct);