import React, { useEffect, useState, Props } from 'react';
import { makeStyles } from '@material-ui/core/styles';
import { Link } from 'react-router-dom';
import { Button, Table, Divider, Pagination } from 'antd';
import { PlusOutlined, EditOutlined, DeleteFilled } from '@ant-design/icons';
import { productService } from '../../_services';

const { Column } = Table;

const useStyles = makeStyles({
    table: {
        minWidth: 650,
    },
    marginRight: {
        marginRight: 10
    }
});

export interface IValues {
    id: number,
    name: string,
    description: string,
    category: string,
    estoque: number,
    price: number,
}

export default function SimpleTable() {
    const classes = useStyles();
    const [data, setData] = useState([] as IValues[]);
    useEffect(() => {
        getData();
    }, []);

    const getData = async () => {
        const customers = await productService.getAll();
        setData(customers);

    }
    const deleteCustomer = async (id: number) => {
        await productService.deleteItem(id);
        getData();
    }

    return (
        <div className="site-layout-content">
            <Link to={{ pathname: "/product/create" }}>
                <Button type="primary" shape="circle" icon={<PlusOutlined />} />
            </Link>
            <Table dataSource={data} size="small" >
                <Column title="Name" dataIndex="name" key="name" />
                <Column title="Description" dataIndex="description" key="description" />
                <Column title="Category" dataIndex="category" key="category" />

                <Column
                    title="Action"
                    key="action"
                    render={(text, record) => (
                        <span>
                            <Link to={{ pathname: "/product/edit/" + text.id }}>
                                <Button type="primary" shape="circle" icon={<EditOutlined />} />
                            </Link>
                            <Divider type="vertical" />
                            <Button onClick={e => deleteCustomer(text.id)} danger type="primary" shape="circle" icon={<DeleteFilled />} />
                        </span>
                    )}
                />
            </Table>
        </div>



    );
}
